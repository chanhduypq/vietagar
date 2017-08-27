<?php

class Default_Model_Muahang {

    public function sendGioHang($id_dat_hang) {
        $data = array();
        $data["is_send"] = "1";
        $db = $this->getDB();
        $db->update("dat_hang", $data, "id_dat_hang=$id_dat_hang");
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
        }
        $identity["is_send"] = true;
        $auth->clearIdentity();
        $auth->getStorage()->write($identity);
    }

    public function getLogoMathang($id_mat_hang) {
        $db = $this->getDB();
        $select = $db->select();
        $select->from("mat_hang", array("logo"));
        $select->where("id_mat_hang=?", $id_mat_hang, "INTEGER");
        $row = $db->fetchRow($select);
        return $row["logo"];
    }

    public function saveMotMatHang($id_mat_hang, $so_luong, $gia, $id_khach_hang) {
        if ($this->existDonDatHangNotSendYet($id_khach_hang) == false) {
            $this->createDonDatHang($id_khach_hang);
        }
        $row = $this->getDonDatHangNotSendYet($id_khach_hang);
        $id_dat_hang = $row["id_dat_hang"];
        $data = array();
        $data["id_dat_hang"] = $id_dat_hang;
        $data["id_mat_hang"] = $id_mat_hang;
        $data["so_luong"] = $so_luong;
        $data["don_gia"] = $gia;
        $db = $this->getDB();
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
        }

        try {
            if ($db->insert("chi_tiet_dat_hang", $data) > 0) {
                $auth->clearIdentity();
                $identity["is_send"] = false;
                $auth->getStorage()->write($identity);
                return true;
            }
        } catch (Exception $e) {
            $db->update("chi_tiet_dat_hang", $data, "id_dat_hang=$id_dat_hang and id_mat_hang=$id_mat_hang");
            $auth->clearIdentity();
            $identity["is_send"] = false;
            $auth->getStorage()->write($identity);
            return true;
        }
        return false;
    }

    public function existDonDatHangNotSendYet($id_khach_hang) {
        $db = $this->getDB();
        $select = $db->select();
        $select->from("dat_hang", array("count(*) as count"));
        $select->where("id_khach_hang=?", $id_khach_hang, "INTEGER");
        $select->where("is_send=0");
        $row = $db->fetchRow($select);
        if ($row["count"] > 0) {
            return true;
        }
        return false;
    }

    public function createDonDatHang($id_khach_hang) {
        $db = $this->getDB();
        $data = array();
        $data["id_khach_hang"] = $id_khach_hang;
        $data["ngay_dat_hang"] = date("Y-m-d h:m:s");
        $data["is_send"] = 0;
        $data["is_receive"] = 0;
        $db->insert("dat_hang", $data);
    }

    public function getDonDatHangNotSendYet($id_khach_hang) {
        $db = $this->getDB();
        $select = $db->select();
        $select->from("dat_hang", array("*"));
        $select->where("id_khach_hang=?", $id_khach_hang, "INTEGER");
        $select->where("is_send=0");
        $row = $db->fetchRow($select);
        return $row;
    }

    public function getDonGia($id_mat_hang) {
        $db = $this->getDB();
        $select = $db->select();
        $select->from("mat_hang", array("gia"));
        $select->where("$id_mat_hang=?", $id_mat_hang, "INTEGER");
        $row = $db->fetchRow($select);
        return $row["gia"];
    }

    public function getGioHangNotSendYet($id_khach_hang) {
        $db = $this->getDB();
        $select = $db->select();
        $select->from(array('a' => 'chi_tiet_dat_hang'), array("*", "(a.don_gia*a.so_luong) as thanh_tien"))
                ->join(array('b' => 'dat_hang'), 'a.id_dat_hang=b.id_dat_hang', array("ngay_dat_hang"))
                ->join(array('c' => 'mat_hang'), 'c.id_mat_hang=a.id_mat_hang', array('ten_mat_hang'))
                ->where('b.is_send=0')
                ->where('b.id_khach_hang=?', $id_khach_hang, 'INTEGER')

        ;

        //echo $select->__toString();exit;
        $rows = $db->fetchAll($select);
        if (!is_array($rows) || count($rows) == 0) {
            return array();
        }

        return $rows;
    }

    public function getThongTinMatHangInDonHangNotSendYet($id_khach_hang, $id_mat_hang) {
        $db = $this->getDB();
        $select = $db->select();
        $select->from(array('a' => 'chi_tiet_dat_hang'), array("*"))
                ->join(array('b' => 'dat_hang'), 'a.id_dat_hang=b.id_dat_hang')
                ->where('a.id_mat_hang=?', $id_mat_hang, '')
                ->where('b.is_send=0')
                ->where('b.id_khach_hang=?', $id_khach_hang, 'INTEGER')

        ;


        $row = $db->fetchRow($select);
        if (!is_array($row) || count($row) == 0) {
            return array();
        }
        $gia_chinh_thuc = $this->getDonGia($id_mat_hang);
        if ($gia_chinh_thuc > $row["don_gia"]) {
            $row["thuong_luong_gia"] = true;
        } else {
            $row["thuong_luong_gia"] = false;
        }
        return $row;
    }

    public function getGioHangsSent($id_khach_hang) {
        $db = $this->getDB();
        $select = $db->select();
        $select->from(array('a' => 'dat_hang'), array("id_dat_hang", "CONCAT(day(ngay_dat_hang),'/',month(ngay_dat_hang),'/',year(ngay_dat_hang)) as ngay_dat_hang"))
                ->where('a.is_send=1')
                ->where('a.id_khach_hang=?', $id_khach_hang, 'INTEGER')

        ;


        $rows = $db->fetchAll($select);
        if (!is_array($rows) || count($rows) == 0) {
            return array();
        }

        return $rows;
    }

    public function getGioHang($id_dat_hang) {
        $db = $this->getDB();
        $select = $db->select();
        $select->from(array('a' => 'chi_tiet_dat_hang'), array("*", "(a.don_gia*a.so_luong) as thanh_tien"))
                ->join(array('b' => 'dat_hang'), 'a.id_dat_hang=b.id_dat_hang', array("ngay_dat_hang"))
                ->join(array('c' => 'mat_hang'), 'c.id_mat_hang=a.id_mat_hang', array('ten_mat_hang'))
                ->where('a.id_dat_hang=?', $id_dat_hang, 'INTEGER')

        ;

        $rows = $db->fetchAll($select);
        if (!is_array($rows) || count($rows) == 0) {
            return array();
        }

        return $rows;
    }

    private function getDB() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);
        return $db;
    }

}