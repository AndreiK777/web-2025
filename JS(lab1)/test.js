function countVowels(str) {
  if (typeof str !== "string") {
      console.log("Ошибка: входной параметр не является строкой");
      return;
    }
  let count = 0;
      for (let i = 0; i < str.length; i++) {
          let symbol = str[i];
          if (symbol === "а" || symbol === "е" || symbol === "ё" || symbol === "и" || symbol === "о" || symbol === "у" || symbol === "ы" || 
              symbol === "э" || symbol === "ю" || symbol === "я") {
                  count ++;
              }
      }
   return count;
}      

console.log(countVowels("аеёиоуыэюя"));
console.log(countVowels("Привет мир!"));
console.log(countVowels("ГГГГГ"));
countVowels(1);