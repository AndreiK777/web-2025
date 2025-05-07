const users = [
    { id: 1, name: "Alice" },
    { id: 2, name: "Bob" },
    { id: 3, name: "Charlie" }
  ];
  
  const names = users.map(user => user.name); // создаем новый массив из users (name)
  
  console.log(names); 