<?php

    function getRegex($pattern){
        if (preg_match('/[^-:\/_{}()a-zA-Z\d]/', $pattern))
            return false; // Invalid pattern

        // Turn "(/)" into "/?"
        $pattern = preg_replace('#\(/\)#', '/?', $pattern);

        // Create capture group for ":parameter"
        $allowedParamChars = '[a-zA-Z0-9\_\-]+';
        $pattern = preg_replace(
            '/:(' . $allowedParamChars . ')/',   # Replace ":parameter"
            '(?<$1>' . $allowedParamChars . ')', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $pattern
        );

        // Create capture group for '{parameter}'
        $pattern = preg_replace(
            '/{('. $allowedParamChars .')}/',    # Replace "{parameter}"
            '(?<$1>' . $allowedParamChars . ')', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $pattern
        );

        // Add start and end matching
        $patternAsRegex = "@^" . $pattern . "$@D";

        return $patternAsRegex;
    }

    // Test it
    $testCases = [
        [
            'route'           => '/hello/:name',
            'url'             => '/hello/sarah',
            'expectedParam'   => ['name' => 'sarah'],
        ],
        [
            'route'           => '/bye/:name(/)',
            'url'             => '/bye/stella/',
            'expectedParam'   => ['name' => 'stella'],
        ],
        [
            'route'           => '/find/{what}(/)',
            'url'             => '/find/cat',
            'expectedParam'   => ['what' => 'cat'],
        ],
        [
            'route'           => '/pay/:when',
            'url'             => '/pay/later',
            'expectedParam'   => ['when' => 'later'],
        ],
    ];

    printf('%-5s %-16s %-39s %-14s %s' . PHP_EOL, 'RES', 'ROUTE', 'PATTERN', 'URL', 'PARAMS');
    echo str_repeat('-', 91), PHP_EOL;

    foreach ($testCases as $test) {
        // Make regexp from route
        $patternAsRegex = getRegex( $test['route'] );

        if ($ok = !!$patternAsRegex) {
            // We've got a regex, let's parse a URL
            if ($ok = preg_match($patternAsRegex, $test['url'], $matches)) {
                // Get elements with string keys from matches
                $params = array_intersect_key(
                    $matches,
                    array_flip(array_filter(array_keys($matches), 'is_string'))
                );

                // Did we get the expected parameter?
                $ok = $params == $test['expectedParam'];

                // Turn parameter array into string
                list ($key, $value) = each($params);
                $params = "$key = $value";
            }
        }

        // Show result of regex generation
        var_dump($ok ? 'PASS' : 'FAIL',$test['route'], $patternAsRegex,$test['url'], $params);
    }