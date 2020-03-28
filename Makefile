check-code:
	echo "PHAN:\n" && ./bin/phan -l src/ && echo "\n\nPHPCS Tests" && bin/phpcs --standard=PSR1,PSR2 tests/ && echo "\n\nPHPCS Src" && bin/phpcs --standard=PSR1,PSR2 src/ && echo "\n\nPHPUnit" && ./bin/phpunit --colors tests
