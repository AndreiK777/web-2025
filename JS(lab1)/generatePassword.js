function generatePassword(length) {
    if (length < 4) {
        console.log("Ошибка: Пароль должен быть длиной минимум 4 символа");
        return;
    }

    const charTypes = {
        small: 'abcdefghijklmnopqrstuvwxyz',
        big: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        digit: '0123456789',
        special: '!@#$%^&*(+-={}|;:,.<>?'
    };

    const allChars = charTypes.small + charTypes.big + charTypes.digit + charTypes.special;
    const keys = Object.keys(charTypes);
    const requiredChars = [];
    // перемешивание массива
    for (let i = 0; i < keys.length; i++) {
        const j = Math.floor(Math.random() * (i + 1));  // Случайный индекс 
        [keys[i], keys[j]] = [keys[j], keys[i]];  // Меняем элементы местами
        const chars = charTypes[keys[i]];
        requiredChars.push(chars[Math.floor(Math.random() * chars.length)]);
    }

    let password = requiredChars.join('');

    for (let i = password.length; i < length; i++) {
        password += allChars[Math.floor(Math.random() * allChars.length)];
    }

    return password;
}


console.log(generatePassword(12));  
console.log(generatePassword(4));   
generatePassword(3); 


