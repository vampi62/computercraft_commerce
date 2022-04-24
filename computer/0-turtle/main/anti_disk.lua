function secu()
	while run_prog do
		local event, side = os.pullEvent("disk")
		disk.eject(side)
		sleep(0.01)
	end
end