<?php
    class Biodata{
        var $nama;
        var $nim;
        var $alamat;
        var $tgllahir;

        function setnama($namamhs){
            $this->nama = $namamhs;
        }
        function getnama(){
            echo "Nama : ", $this->nama;
        }
        function setnim($nimmhs){
            $this->nim = $nimmhs;
        }
        function getnim(){
            echo "NIM : ", $this->nim;
        }
        function setalamat($alamatmhs){
            $this->alamat = $alamatmhs;
        }
        function getalamat(){
            echo "Alamat : ",$this->alamat;
        }
        function settgllahir($tgllahirmhs){
            $this->tgllahir = $tgllahirmhs;
        }
        function gettgllahir(){
            echo "Tanggal Lahir : ", $this->tgllahir;
        }
        public function getBiodata() {
            return [
                'Nama' => $this->nama,
                'NIM' => $this->nim,
                'Alamat' => $this->alamat,
                'Tanggal Lahir' => $this->tgllahir
            ];   
        }   
    }
?>