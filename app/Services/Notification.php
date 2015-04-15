<?php


namespace App\Services;




use Amaran;

class Notification {


    public function message ($message, $type='success'){

switch ($type) {
    case 'success':
        $color='#27ae60';
        $text_color = '#fff';
        break;
    case 'warning':
        $color='rgb(254, 246, 221)';
        $text_color = 'rgb(149, 125, 50)';
        break;
    case 3:
        echo "Number 3";
        break;
    default:
        $color='#27ae60';
}



       Amaran::theme('colorful')->content([
            'message'=>$message,
            'bgcolor'=>$color,
            'color'=>$text_color
        ])->flash()
            ->position('top right')
            ->create();


    }

} 