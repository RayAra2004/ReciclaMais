<?php

    $senhas = [
        'A!b2C$d',
        '3eF&gH7i',
        'J@kL9mN',
        'oP1qR#sU',
        'V2wX$tYz',
        '4A%bBcD5',
        'eFgH6i#J',
        '7KlM$nOp',
        'Q8rS*tUv',
        '9WxYzZ#0',
        'a1B2C!dE',
        'f3G$hI4',
        'j5K*lMn',
        'O6pQ&rS7',
        't8UvW@xY',
        '9ZaB#cD0',
        'eF1gH2i%',
        'J3kLm4Nn',
        'oP5qR6sT',
        'uV7wX8yZ',
        '9AaB&cDd',
        'eE3fGgH%',
        '5IjKlMmN',
        '6oPqR7sU',
        '8tVwX9yZ',
        'a1BbC2d!',
        '3eF4gH%I',
        'J5kLm6Nn',
        'oP7qR#sT',
        'U8vWxY9z',
        'A0aB1cDd',
        'e2F3gH4i',
        'J5kL6MmN',
        '7oPqR8sU',
        'VwX9yZ@0',
        'a1B2bC3d',
        '4eFg5H%i',
        'J6kLm7Nn',
        'oP8qR9sT',
        'uVwXyZ@0'
    ];

    $hashes = [];

    foreach ($senhas as $senha) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $hashes[] = $hash;
    }

    // Exibindo os hashes gerados
    foreach ($hashes as $hash) {
        echo $hash . "<br>";
    }
?>