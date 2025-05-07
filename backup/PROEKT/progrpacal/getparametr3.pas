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
  WHILE QueryString <> ' '
  DO
    BEGIN
	  READ(Ch);
	  IF Ch = '?'
	  THEN 
	    WHILE Ch <> '='
		DO 
		  BEGIN
		    Key
		
      StartPos := StartPos + Length(ParamStart);
      ParamEnd := '&';
      EndPos := Pos(ParamEnd, QueryString, StartPos);
      IF EndPos = 0
      THEN
        EndPos := Length(QueryString) + 1;
      GetQueryStringParameter := Copy(QueryString, StartPos, EndPos - StartPos)
    END;
  IF StartPos = 0
  THEN
    GetQueryStringParameter := ''
END;

BEGIN {WorkWithQueryString}
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('Parametr1: ', GetQueryStringParameter (''))
END. {WorkWithQueryString}
