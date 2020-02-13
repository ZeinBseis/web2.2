<?php
  $command = escapeshellcmd('python -c "from weatherdata import getWeatherData; getWeatherData()"');
  shell_exec($command);
?>