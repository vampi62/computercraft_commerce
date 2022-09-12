function convertkey_number_altgr(numberkey)
	local stringkey = ""
	if global_clavier_maj["altgr"] then
		if numberkey == "zero" then
			stringkey = "@"
		end
	else
		local numbertab = {"0","1","2","3","4","5","6","7","8","9","-","+",".","?","/"}
		local stringtab = {"zero","one","two","three","four","five","six","seven","eight","nine","leftBracket","equals","period","comma","slash"}
		for j=1, #numbertab do
			if numberkey == stringtab[j] then
				stringkey = numbertab[j]
				break
			end
		end
	end
	return stringkey
end