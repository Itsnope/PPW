<?php
    class Mobil{
        var $bensin;

        function maju(){
            //aksi maju menghabiskan 2 liter
            $this->bensin = $this->bensin - 2;
        }

        function mundur(){
            //aksi mundur menghabiskan 1 liter
            $this->bensin = $this->bensin - 1;
        }

        function isibensin($tambah){
            $this->bensin = $this->bensin + $tambah;
        }
        
        function sisabensin(){
            return $this->bensin;
        }
    }

    $mobil1 = new Mobil();
    $mobil1->isibensin(6);
    echo "Mobil melakukan isi bensin. Sisa bensin :
    ",$mobil1->sisabensin()," Liter<br/>";
        $mobil1->maju();
    echo "Mobil melakukan aksi Maju. Sisa Bensin :
    ",$mobil1->sisabensin()," Liter<br/>";
        $mobil1->mundur();
    echo "Mobil melakukan aksi Mundur. Sisa Bensin :
    ",$mobil1->sisabensin()," Liter<br/>";
        $mobil1->isibensin(6);
    echo "Mobil melakukan isi bensin. Sisa bensin :
    ",$mobil1->sisabensin()," Liter<br/>";


?>