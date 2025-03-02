PROGRAM HelloName(INPUT, OUTPUT);

USES
  DOS;

VAR
  QueryString, Name: STRING;
  NamePos: INTEGER;
BEGIN {HelloName}
  QueryString := GetEnv('QUERY_STRING');
  WRITELN('Content-Type: text/plain');
  WRITELN;
  NamePos := Pos('name=', QueryString); {�饬 ��ࠬ��� 'name' � QUERY_STRING}
  IF NamePos > 0 THEN {'name' ������}
    Name := Copy(QueryString, NamePos + 5, Length(QueryString) - NamePos - 4)
  ELSE {'name' �� ������}
    Name := 'Anonymous';
  WRITELN('Hello dear, ', Name, '!')
END. {HelloName}
