function countVowels(str) {
    if (typeof str !== "string") {
      console.log("Ошибка: входной параметр не является строкой");
      return;
    }
  
    const vowels = ["а", "е", "ё", "и", "о", "у", "ы", "э", "ю", "я"];
    let count = 0;
  
    for (let i = 0; i < str.length; i++) {
        let symbol = str[i]; 
        if (vowels.includes(symbol)) {
          count++;
        }
      }
      
    return count;
  }    

console.log(countVowels("аеёиоуыэюя"));
console.log(countVowels("Привет мир!"));
console.log(countVowels("ГГГГГ"));
countVowels(1);