local sides = {"top","bottom","left","right","front","back"}
for j=1, #sides do
	if peripheral.getType(sides[j]) == "modem" then
		rednet.open(sides[j])
	end
end
run_prog = true
mise_a_jour = false
if fs.exists("update_var") then
	shell.run("update_var")
end
if fs.exists("maj_program") then
	shell.run("maj_program")
end
if fs.exists("maj_program_ok") then
	mise_a_jour = true
	fs.delete("maj_program_ok")
end
while run_prog do
	require("init.lua")
end