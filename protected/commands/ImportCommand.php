<?php
/**
* Command tool import student
*/
class ImportCommand extends CConsoleCommand
{
	protected $_header = ["SDB","MSV","HOTEN","NGAYSINH","GIOITINH","LOP"];
	protected $_connection;

	public function __construct()
	{
		$this->_connection = Yii::app()->db;
	}

	public function run($args)
	{
		if (count($args)) {
			$file = $args[0];
			if (file_exists($file)) {
				$this->doImport($file);
			} else {
				$this->printCLI('File khong ton tai vui long kiem tra lai');
			}
		} else {
			$this->printCLI("Vui lòng chọn file import!");
		}
	}

	protected function doImport($file = '')
	{
		Yii::import('ext.phpexcel.XPHPExcel');
		XPHPExcel::init();
		$objReader     = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel   = $objReader->load($file);
		$objWorksheet  = $objPHPExcel->getActiveSheet();
		$highestRow    = $objWorksheet->getHighestRow(); // e.g. 10
		if ($highestRow < 2) {
			$this->printCLI('File khong dung format');
		}
		$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
		if ($highestColumn != 'F') {
			$this->printCLI('File khong dung format');
		}
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $_header = [];
        for ($col = 0; $col < $highestColumnIndex; $col++) {
            $_header[$col] = strtoupper(trim($objWorksheet->getCellByColumnAndRow($col, 1)->getValue()));
        }
        if ($this->_header != $_header) {
        	$this->printCLI('File header khong dung');
        }
        $_excelData = [];
		for ($row = 2; $row <= $highestRow; ++$row) {
			$_excelData[$row] = [];
			for ($col = 0; $col < $highestColumnIndex; ++$col) {
				$field = isset($_header[$col]) ? $_header[$col] : false;
				if (!$field) {
					unset($_excelData[$row]);
					break;
				}
				$_excelData[$row][$field] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			}
		}
		if ($_excelData) {
			$counter = 0;
			$total   = count($_excelData);
			foreach ($_excelData as $preview) {
				$counter++;
				if ($counter > 5) break;
				try {
					$this->printCLI(sprintf("+-------+------------+----------------------+--------------+-----+------------+"));
					$this->printCLI(sprintf("| %5s | %-10s | %-20s | %-12s | %-3s | %-10s |", $preview['SDB'], $preview['MSV'], $preview['HOTEN'], $preview['NGAYSINH'], $preview['GIOITINH'] ? "Nam" : "Nu", $preview['LOP']));
				} catch (Exception $e) { }
			}
			$this->printCLI(sprintf("+-------+------------+----------------------+--------------+-----+------------+"));
			$this->printCLI("Xem truoc {$counter} sinh vien ben tren");
			$doImport = $this->confirm("Import {$total} sinh vien ? ");
			if (!$doImport) {
				$this->printCLI("Da huy import!");
				return;
			}
			$run     = 0;
			$success = 0;
			foreach ($_excelData as $_student) {
				$run++;
				if($this->insert($_student)) {
					$success++;
					$this->printCLI("Status: [SUCCEED] [{$run}/{$total}] | ADDED {$_student['MSV']} - {$_student['HOTEN']}");
				} else {
					$this->printCLI("Status: [FAILED ] [{$run}/{$total}] | ERROR {$_student['MSV']} - {$_student['HOTEN']}");
				}
			}
		}
	}

	private function printCLI($messages='')
	{
		if (is_array($messages)) {
			echo json_encode($messages, JSON_PRETTY_PRINT)."\n";
			return;
		}
		echo $messages."\n";
	}

	protected function insert($data = []) {
		if (count($data) != 6) return false;
		try {
			$sql = "INSERT INTO `mc_student` (`st_sbd`, `st_code`, `st_name`, `st_dob`, `st_sex`, `st_class`) VALUES ('{$data['SDB']}','{$data['MSV']}','{$data['HOTEN']}','{$data['NGAYSINH']}','{$data['GIOITINH']}','{$data['LOP']}');";
			return $this->_connection->createCommand($sql)->execute();
		} catch (Exception $e) {
			return false;
		}
	}
}