function convert_key_qwerty_vers_azerty(key)
	local qwerint = {
		["grave"]="apostrophe",
		["minus"]="leftBracket",
		["q"]="a",
		["w"]="z",
		["leftBracket"]="rightBracket",
		["rightBracket"]="semicolon",
		["capsLock"]="capsLock",
		["a"]="q",
		["semicolon"]="m",
		["apostrophe"]="grave",
		["nil"]="",
		["z"]="w",
		["m"]="comma",
		["comma"]="period",
		["period"]="slash",
		["slash"]="grave",
		["numPadEnter"]="enter"
	}
	if qwerint[key] == nil then
		qwerint[key] = key
	end
	return qwerint[key]
end