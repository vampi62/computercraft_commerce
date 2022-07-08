function ntp()
	returned_time = http_get_ntp(refresh_time)
    -- {Minute,Hour,day,mois,refresh_time}
    while true do
		sleep(60)
		returned_time[1] = returned_time[1] + 1
		if returned_time[1] >= 60 then
			returned_time[1] = 0
			returned_time[2] = returned_time[2] + 1
			returned_time[5] = returned_time[5] - 1
            if returned_time[5] <= 0 then
                returned_time = http_get_ntp(refresh_time)
            end
		end