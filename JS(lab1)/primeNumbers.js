function isPrimeNumber(input) {
    function checkPrime(n) {
        if (n < 2) return false;
        for (let i = 2; i < n; i++) {
            if (n % i == 0) return false;
        }
        return true;
    }

    function writeNum(number) {

        if (checkPrime(number)) {
            console.log(number + " простое число");
        } else {
            console.log(number + " не простое число");
        }
    }

    if (Array.isArray(input)) {
        for (let i = 0; i < input.length; i++) {
            let num = input[i];

            if (typeof num !== "number") {
                console.log("Ошибка: элемент массива не является числом");
                return; // найден некорректный элемент
            }
        }

        for (let i = 0; i < input.length; i++) {
            let num = input[i];
            writeNum(num);
        }

    } else if (typeof input === "number") {
            writeNum(input);
    } else {
        // не число и не массив
        console.log("Ошибка: переданный параметр не является числом или массивом чисел");
    }
}

isPrimeNumber(3);           
isPrimeNumber(4);  
isPrimeNumber(0);          
isPrimeNumber([3, 4, 5]);   
isPrimeNumber([0, 4, 5]);
isPrimeNumber('a');
isPrimeNumber([3, 'a', 5]);