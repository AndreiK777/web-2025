PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  DOS;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  QueryString, ParamStart, ParamEnd: STRING;
  StartPos, EndPos: INTEGER;
BEGIN
  QueryString := GetEnv('QUERY_STRING'); 
  ParamStart := Key + '=';
  StartPos := Pos(ParamStart, QueryString); 

  IF StartPos > 0 THEN
  BEGIN
    StartPos := StartPos + Length(ParamStart); 
    ParamEnd := '&';
    EndPos := Pos(ParamEnd, QueryString, StartPos); 
    IF EndPos = 0 THEN
      EndPos := Length(QueryString) + 1; 
    GetQueryStringParameter := Copy(QueryString, StartPos, EndPos - StartPos); 
  END
  ELSE
    GetQueryStringParameter := '';
END;

BEGIN {WorkWithQueryString}
  VAR
    QueryString, ParamStart, ParamEnd: STRING;
    StartPos, EndPos: INTEGER;
    Key, Value: STRING;
  BEGIN
    WRITELN('Content-Type: text/plain');
    WRITELN; 
    QueryString := GetEnv('QUERY_STRING'); 
    StartPos := 1; 

    WHILE QueryString <> '' 
	DO 
      BEGIN
        ParamStart := '='; 
        StartPos := Pos(ParamStart, QueryString); 
      IF StartPos > 0 
	  THEN 
        BEGIN
          EndPos := StartPos - 1; 
          Key := Copy(QueryString, 1, EndPos); 
          StartPos := StartPos + 1; 
          ParamEnd := '&'; 
          EndPos := Pos(ParamEnd, QueryString, StartPos); 
          IF EndPos = 0 
		  THEN
            EndPos := Length(QueryString) + 1; 
            Value := Copy(QueryString, StartPos, EndPos - StartPos); 
            WRITELN(Key, ': ', Value); 
            StartPos := EndPos + 1; 
            QueryString := Copy(QueryString, StartPos, Length(QueryString) - StartPos + 1); 
            StartPos := 1; 
        END
      ELSE
        QueryString := ''; { Если '=' не найден, завершаем цикл }
    END;
  END;
END. {WorkWithQueryString}