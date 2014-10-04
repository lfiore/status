setInterval(function() {

	$.get('ajaxinfo.php', function(data) {

		info = $.parseJSON(data);

		services = info[0];
		services_length = services.length;
		var i = 0;
		$('#services li').each(function()
		{
			if (services[i] === true)
			{
				$(this).not('.online').addClass('online');
			}
			else
			{
				if ($(this).hasClass('online'))
				{
					$(this).removeClass('online');
				}
			}

			i++;
		});

		servers = info[1];
		servers_length = services.length;
		var i = 0;
		$('#servers li').each(function()
		{
			if (servers[i] === true)
			{
				$(this).not('.online').addClass('online');
			}
			else
			{
				if ($(this).hasClass('online'))
				{
					$(this).removeClass('online');
				}
			}

			i++;
		});

		cpuload = info[2];
		$('#cpuload-1').html(cpuload[0]);
		$('#cpuload-5').html(cpuload[1]);
		$('#cpuload-15').html(cpuload[2]);

		mem = info[3];
		$('#mem-usage').html(mem['usage']);
		$('#mem').val(mem['usage']);
		$('#mem-cached').html(mem['cached']);

		disk = info[4];
		$('#disk-usage').html(disk['usage']);
		$('#disk').val(disk['usage']);

	});

}, 2000);

setInterval(function() {

	if (parseInt($('#uptime-seconds').html()) === 59) {
		$('#uptime-seconds').html(0);
		if (parseInt($('#uptime-minutes').html()) === 59) {
			$('uptime-minutes').html(0);
			if (parseInt($('#uptime-hours').html()) === 23) {
				$('#uptime-hours').html(0);
				$('#uptime-days').html(parseInt($('#uptime-days').html()) + 1);
			} else {
				$('#uptime-hours').html(parseInt($('#uptime-hours').html()) + 1);
			}
		} else {
			$('#uptime-minutes').html(parseInt($('#uptime-minutes').html()) + 1);
		}
	} else {
		$('#uptime-seconds').html(parseInt($('#uptime-seconds').html()) + 1);
	}

}, 1000);