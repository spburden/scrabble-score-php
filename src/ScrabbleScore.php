<?php
    class ScrabbleScore
    {
        public $scrabbleArray = array("A"=>1, "E"=>1, "I"=>1, "O"=>1 ,"U"=>1 ,"L"=>1 ,"N"=>1 ,"R"=>1 ,"S"=>1 ,"T"=>1, "D"=>2, "G"=>2, "B"=>3, "C"=>3, "M"=>3,
        "P"=>3, "F"=>5, "H"=>4, "V"=>4, "W"=>4, "Y"=>4, "K"=>5, "J"=>8, "X"=>8, "Q"=>10, "Z"=>10);

        function getLetterScore ($letter)
        {
            $letter = strtoupper($letter);
            $score = 0;
            if(array_key_exists($letter, $this->scrabbleArray)){
                $score += $this->scrabbleArray[$letter];
                return $score;
            }
            else{
                return false;
            }

        }
        function getWordScore($word)
        {
            $charArray = str_split($word);
            $score = 0;
            foreach($charArray as $char){
                $score += $this->getLetterScore($char);
                if ($this->getLetterScore($char) == false){
                    $score = "An imaginary scrabble letter has been entered, TRY AGAIN!";
                    return $score;
                }
            }
            return $score;
        }



    }
?>
