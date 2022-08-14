function scroll()
	global_scroll = 0
	while true do
		local event, scrollDirection, x, y = os.pullEvent("mouse_scroll")
		if scrollDirection == -1 then
			global_scroll = global_scroll + 1
		elseif scrollDirection == 1 then
			if global_scroll > 0 then
				global_scroll = global_scroll - 1
			end
		end
	end
end