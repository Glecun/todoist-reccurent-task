# todoist-reccurent-task
Add custom recurrent task to your todoist

## Prerequisites
Replace the following lines:
```
$token = "[YOUR_TOKEN]";
$toProject = '[YOUR_PROJECT]';
```
And modify to your needs the array of recurrent tasks
```
$tasks = array (
    array(
		"nom" => "A task",
		"note" => "",
		"valide" => true,
		"tempo" => 7,
		"startDate" => '07-11-2017'
	),
	array(
		"nom" => "Another task",
		"note" => "with desription",
		"valide" => true,
		"tempo" => 15,
		"startDate" => '19-12-2017'
	)
);
```