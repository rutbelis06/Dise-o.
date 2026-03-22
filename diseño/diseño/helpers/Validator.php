<?php
class Validator {
    public static function validate($data, $rule) {
        switch ($rule) {
            case 1: 
                return preg_match('/^[A-Z\s]+$/u', $data);
            case 2: 
                return preg_match('/^[A-Z]{1}$/', $data);
            case 3: 
                return preg_match('/^[a-zA-Z0-9]+$/', $data);
            case 4:
                return preg_match('/^[0-9]+$/', $data);
            case 5:
                return preg_match('/^[vVeE][0-9]+$/', $data);
            case 6: 
                return preg_match('/^[vejgopVEJGOP][0-9]+$/', $data);
            case 7: 
                return preg_match('/^[VE][0-9]+$/', $data);
            case 8: 
                return preg_match('/^[VEJGOP][0-9]+$/', $data);
            case 9: 
                return preg_match('/(\.com|\.gob|\.ve|\.org|\.es|\.co)$/', $data);
            case 10: 
                return preg_match('/^(?!http:\/\/|https:\/\/).+$/', $data);
            case 11: 
                return preg_match('/^(?=.*[A-Z])(?=.*[0-9])[^-_\/\\\\<>,]+$/', $data);
            case 12: 
                return preg_match('/^[a-zA-Z0-9].*[^a-zA-Z]$/', $data);
            case 13:
                return preg_match('/^[\p{L}]+$/u', $data);
            case 14: 
                return preg_match('/^[a-zA-Zα-ωΑ-Ω0-9._%+-]+@[a-zA-Zα-ωΑ-Ω0-9.-]+\.[a-zA-Z]{2,}$/', $data);
            case 15: 
                return preg_match('/@(gmail\.com|hotmail\.com|outlook\.com|yahoo\.com)$/i', $data);
            case 16: 
                return preg_match('/^(?=(.*[a-zA-Z]){3,})(?=(.*[0-9]){2,})(?=.*[^a-zA-Z0-9]).{8,}$/', $data);
            case 17: 
                if (preg_match('/(\.com|\.net|\.org)/', $data)) return false;
                return preg_match('/^[a-zA-Z0-9\s,;°#\-\/]{4,270}$/', $data);
            case 18: 
                if (!str_starts_with($data, ' ')) return false;
                if (strlen($data) < 12 || strlen($data) > 36) return false;
                
                preg_match_all('/[^a-zA-Z0-9\s]/', $data, $symbols);
                if (count($symbols[0]) > 6 || count(array_unique($symbols[0])) != count($symbols[0])) return false;
                
                preg_match_all('/[A-Z]/', $data, $ucase);
                if (count($ucase[0]) < 3 || count(array_unique($ucase[0])) != count($ucase[0])) return false;
                
                return true;
            default:
                return false;
        }
    }
}