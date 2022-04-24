local function sync_ntp()
	local http_return = http.get("http://"..httpdns.."/update/index.php?action=time")
	local http_return = http_return.readAll()
	local taille = string.len(http_return)
	local y = 0
	local balise = "<br />"
	local tag = 1
	local balise_pos_x_depart = {}
	local balise_pos_x_fin = {}
	repeat
		local y = y + 1
		local test = string.sub(http_return,y,y+5)
		if string.find(test,balise) then
			balise_pos_x_depart[tag] = y - 1
			balise_pos_x_fin[tag] = y + 6
			local tag = tag + 1
		end
	until y >= taille
	Minute = string.sub(http_return,1,balise_pos_x_depart[1])
	Hour = string.sub(http_return,balise_pos_x_fin[1],balise_pos_x_depart[2])
	am_pm = string.sub(http_return,balise_pos_x_fin[2],balise_pos_x_depart[3])
	day = string.sub(http_return,balise_pos_x_fin[3],balise_pos_x_depart[4])
	mois = string.sub(http_return,balise_pos_x_fin[4],balise_pos_x_depart[5])
	Minute = tonumber(Minute)
	Hour = tonumber(Hour)
	day = tonumber(day)
	mois = tonumber(mois)
	if am_pm == "PM" then
		Hour = Hour + 12
		if Hour > 23 then
			Hour = 12
		end
	end
end
function ntp()
	sync_ntp()
	while run_prog do
		sleep(60)
		Minute = Minute + 1
		if Minute >= 60 then
			Minute = 0
			Hour = Hour + 1
			sync_ntp()
		end
	end
end