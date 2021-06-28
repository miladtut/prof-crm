<?php
return [
    'regular'=>[
        ['waiting quotation'],//0 0
        ['quotation sent'],//1
        ['waiting sample', 'quotation modified'],//2 1
        ['sample requested'],//3
        ['sample processing'],//4
        ['sample shipped'],//5
        ['sample received'],//6
        ['waiting pilot price', 'sample rejected'],//7 2
        ['pilot price sent'],//8 3
        ['waiting PI', 'pilot price modified'],//9
        ['sending PO'],//10 4
        ['waiting PCOA'],//11 5
        ['PCOA sent'],//12 6
        ['waiting draft ship files', 'PCOA modified'],//13
        ['draft ship files sent'],//14 7
        ['waiting final ship files', 'draft ship files modified'],//15
        ['final ship files sent'],//16 8
        ['tracking number for original Documents','final ship files modified'],//17 9
        ['closed', 'declined'],//18
    ],
    'logistic'=>[
        ['waiting quotation'],//0
        ['quotation sent'],//1
        ['waiting sample', 'quotation modified'],//2
        ['sample requested'],//3
        ['sample processing'],//4
        ['sample shipped'],//5
        ['sample received'],//6
        ['waiting pilot price', 'sample rejected'],//7
        ['pilot price sent'],//8
        ['waiting PI', 'pilot price modified'],//9
        ['sending PO'],//10
        ['sending PO to supplier'],//11
        ['waiting supplier documents'],//12
        ['sending customer documents'],//13
        ['waiting import approval', 'continue complete document'],//14
        ['PCOA shipping documents sent'],//15
        ['waiting original document', 'PCOA modification requested'],//16
//        ['waiting payment'],
        ['sending customer clearance documents'],//17
        ['customer clearance documents sent'],//18
//        ['clearance from EDA'],//
        ['delivery notes uploaded'],//19
//        ['submission for clearance at port'],
//        ['checking pricing reviewing'],
//        ['narcotic review'],
//        ['import review'],
//        ['custom review'],
//        ['custom fees'],
//        ['payment'],
//        ['release'],
//        ['delivery to warehouse'],
//        ['collection'],
        ['paid']//20
    ],

];
