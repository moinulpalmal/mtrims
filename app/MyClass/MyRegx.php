<?php
      namespace App\MyClass;
      class MyRegx
      {
          public static function ConvertToTwoDigitString($value){
              return sprintf("%02d", $value);
          }

          public static function ConvertToThreeDigitString($value){
              return sprintf("%03d", $value);
          }

          public static function ConvertToFourDigitString($value){
              return sprintf("%04d", $value);
          }

          public static function ConvertToFiveDigitString($value){
              return sprintf("%05d", $value);
          }

          public static function ConvertToTenDigitString($value){
              return sprintf("%010d", $value);
          }

          public static function ConvertToFifteenDigitString($value){
              return sprintf("%015d", $value);
          }

          public static function ConvertToTwentyDigitString($value){
              return sprintf("%020d", $value);
          }
      }
