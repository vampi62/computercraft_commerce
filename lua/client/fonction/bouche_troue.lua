function bouche_trou(text,lenstring)
	return_text = ""
	for j=string.len(text), lenstring do
		return_text = return_text.." "
	end
	return text..return_text
end