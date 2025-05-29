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
  NamePos := Pos('name=', QueryString);
  IF NamePos > 0
  THEN
    Name := Copy(QueryString, NamePos + 5)
  ELSE
    Name := 'Anonymous';
  WRITELN('Hello dear, ', Name, '!')
END. {HelloName}
