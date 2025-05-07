function mapObject(obj, callback) {
    const result = {};
    const keys = Object.keys(obj); // массив ключей объекта
  
    for (let i = 0; i < keys.length; i++) {
      const key = keys[i];
      result[key] = callback(obj[key]);
    }
  
    return result;
  }
  
  const nums = { a: 1, b: 2, c: 3 };
  
  console.log(mapObject(nums, x => x * 2));

  