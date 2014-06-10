@IF EXIST "%~dp0\node.exe" (
  "%~dp0\node.exe"  "%~dp0\node_modules\uglifycss\uglifycss" %*
) ELSE (
  node  "%~dp0\node_modules\uglifycss\uglifycss" %*
)