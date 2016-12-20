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
 
function showGoods(partnerId)
{       
	var toLoad = document.getElementById('toLoad');
	var partnerGoods = document.getElementsByClassName('o-container');
	for(var i = 0; i < partnerGoods.length; i++)
	{
		partnerGoods[i].classList.add('hide');
	}
        
	BX.ajax({
		url: "/ajax/show_component.php",
		data: {'id': partnerId},
		method: 'POST',
		dataType: 'html',
		timeout: 30,
		async: true,
		processData: true,
		scriptsRunFirst: true,
		emulateOnload: true,
		start: true,
		cache: false,
		onsuccess: function(data)
		{
			toLoad.innerHTML = data;            
		},
		onfailure: function()
		{
		}
	});      
}
