<?php
    class Biodata{
        var $nama;

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
    }

    $mhs1 = new Biodata();

    $mhs1->setnama("Noverianus");
    echo $mhs1->getnama()."</br>";
    $mhs1->setnim("22220027");
    echo $mhs1->getnim()."</br>";
    $mhs1->setalamat("Kalimantan Utara");
    echo $mhs1->getalamat()."</br>";
    $mhs1->settgllahir("11 November 2003");
    echo $mhs1->gettgllahir()."</br>";          
    
?>