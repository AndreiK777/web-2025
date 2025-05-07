PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  DOS;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  QueryString, Param, Value: STRING;
  KeyPos, EqualPos, AmpersandPos: INTEGER;
BEGIN
  { Получаем строку запроса }
  QueryString := GetEnv('QUERY_STRING');
  
  { Выводим для отладки содержимое QUERY_STRING }
  WRITELN('QUERY_STRING: ', QueryString);
  
  { Ищем позицию первого вхождения ключа Key в строку запроса }
  KeyPos := POS(Key + '=', QueryString);

  IF KeyPos > 0 THEN
  BEGIN
    { Находим позицию знака "=" после ключа }
    EqualPos := KeyPos + LENGTH(Key);

    { Ищем позицию следующего символа "&" или конца строки, чтобы выделить значение параметра }
    AmpersandPos := POS('&', Copy(QueryString, EqualPos, LENGTH(QueryString)));

    IF AmpersandPos > 0 THEN
      { Извлекаем значение параметра, обрезая строку до символа "&" }
      Value := Copy(QueryString, EqualPos, AmpersandPos - 1)
    ELSE
      { Если нет символа "&", то значение параметра идет до конца строки }
      Value := Copy(QueryString, EqualPos, LENGTH(QueryString));

    { Возвращаем значение параметра }
    GetQueryStringParameter := Value;
  END
  ELSE
    { Если параметр не найден, возвращаем пустую строку }
    GetQueryStringParameter := '';
END;

BEGIN { WorkWithQueryString }
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'));
END. { WorkWithQueryString }
