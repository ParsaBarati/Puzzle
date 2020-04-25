<?php
namespace Seeder\utils;
use Finglify;

include 'finglify.php';
class Generators
{
    function generateEmail($name)
    {
        if (is_array($name)) {
            foreach ($name as $index => $item) {
                return $this->generateEmail($item);
            }
        } else {
            $Fingil = new Finglify();
            $email = [
                "@gmail.com",
                "@yahoo.com",
                "@mail.com",
                "@outlook.com",
                "@nsn.com",
                "@live.com"
            ];
            return $Fingil->translate(is_string($name) ? $name : 'noname') . $email[rand(0, 5)];
        }
    }

    function generateMobileNum()
    {
        $mobile = '09000000000';
        $mobile[2] = rand(0, 9);
        $mobile[3] = rand(0, 9);
        $mobile[4] = rand(0, 9);
        $mobile[5] = rand(0, 9);
        $mobile[6] = rand(0, 9);
        $mobile[7] = rand(0, 9);
        $mobile[8] = rand(0, 9);
        $mobile[9] = rand(0, 9);
        return $mobile;
    }

    function generateTelNum($state = false)
    {
        $pre = '0' . rand(0, 8) . rand(0, 9);
        if ($state != false) {
            $pre = is_array($state) ? $state['telCode'] : is_object($state->telCode) ? $state->telCode : '0' . rand(0, 8) . rand(0, 9);
        }
        $tel = $pre . '00000';
        $tel[3] = rand(0, 9);
        $tel[4] = rand(0, 9);
        $tel[5] = rand(0, 9);
        $tel[6] = rand(0, 9);
        $tel[7] = rand(0, 9);
        return $tel;
    }

    function generateNcode()
    {
        $res = array();
        for ($i = 0; $i < 10; $i++) {
            $res[] = rand(0, 9);
        }
        return implode("", $res);
    }

    function getState()
    {
        $decoded = json_decode(file_get_contents(__DIR__ . '/states.json'), true);
        return $decoded[rand(0, sizeof($decoded) - 1)];
    }

    function getCity($state = array())
    {
        $decoded = json_decode(file_get_contents(__DIR__ . '/cities.json'), true);
        if (sizeof($state) > 0) {
            foreach ($decoded as $item) {
                if ($item['state'] == $state['id']) {
                    $city = $item;
                } else {
                    continue;
                }
            }
        } else {
            $city = $decoded[rand(0, sizeof($decoded) - 1)];
        }
        return $city;
    }

    function generateAWord()
    {
        $decoded = json_decode(file_get_contents(__DIR__ . '/words.json'), true);
        return $decoded[rand(0, sizeof($decoded) - 1)];
    }

    function generateUserName($name)
    {
        $Fingil = new Finglify();
        return $Fingil->translate(is_string($name) ? $name . strrev($name) : 'username');
    }

    function generatePassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$^%&*';
        $charactersLength = strlen($characters);
        $randomString = '';
        while (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$^%&*-]).{12,}$/', $randomString)) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return sha1(md5($randomString));
    }

    function generateName()
    {
        $decoded = json_decode(file_get_contents(__DIR__ . '/fnames.json'), true);
        return $decoded[rand(0, sizeof($decoded) - 1)];
    }

    function generateLastName()
    {
        $decoded = json_decode(file_get_contents(__DIR__ . '/fnames.json'), true);
        return $decoded[rand(0, sizeof($decoded) - 1)];
    }
}