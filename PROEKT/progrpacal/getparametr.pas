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
  IF StartPos > 0
  THEN
    BEGIN
      StartPos := StartPos + Length(ParamStart);
      ParamEnd := '&';
      EndPos := Pos(ParamEnd, QueryString, StartPos);
      IF EndPos = 0
      THEN
        EndPos := Length(QueryString) + 1;
      GetQueryStringParameter := Copy(QueryString, StartPos, EndPos - StartPos)
    END
  ELSE
    GetQueryStringParameter := ''
END;

BEGIN {WorkWithQueryString}
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'))
END. {WorkWithQueryString}
