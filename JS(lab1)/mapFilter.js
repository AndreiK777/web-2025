const numbers = [2, 5, 8, 10, 3];

const resultMap = numbers.map(num => num * 3); // создаем новы массив
console.log(resultMap);  

const resultFilter =  resultMap.filter(num => num > 10);  // оставляем только соответсвующие условию
console.log(resultFilter); 
