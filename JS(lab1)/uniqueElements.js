function uniqueElements(arr) {
    const obj = {};
    
    for (let i = 0; i < arr.length; i++) {
      const key = String(arr[i]);
      
      if (obj[key] === undefined) {
        obj[key] = 1;
      } else {
        obj[key] += 1;
      }
    }
    
    return obj;
  }

  console.log(uniqueElements(['привет', 'hello', 1, '1']));
  console.log(uniqueElements(['aaa', 'hello', 1, '1', 'aaa']));