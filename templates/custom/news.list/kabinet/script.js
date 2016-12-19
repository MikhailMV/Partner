function changeActivity(id)
{       
	BX.ajax({
		url: "/ajax/change_active.php",
		data: {'id': id},
		method: 'POST',
		dataType: 'json',
		timeout: 30,
		async: true,
		processData: true,
		scriptsRunFirst: true,
		emulateOnload: true,
		start: true,
		cache: false,
		onsuccess: function(data)
		{
			window.location.reload();            
		},
		onfailure: function()
		{
		}
	}); 
}
