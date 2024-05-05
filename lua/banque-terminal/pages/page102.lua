page102 = basalt.createFrame()
x, y = term.getSize()

page102:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page101:show()
    end)

page102:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"changer mdp"/2), 2)
    :setText("changer mdp")
    :setSize(#"changer mdp",1)

page102:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"ancien mdp"/2), 4)
    :setText("ancien mdp")
    :setSize(#"ancien mdp",1)

local oldMdp = page102:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 5)
    :setSize(32,1)
    :setInputLimit(31)
    :setInputType("password")

page102:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"nouveau mdp"/2), 7)
    :setText("nouveau mdp")
    :setSize(#"nouveau mdp",1)

local newMdp = page102:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 8)
    :setSize(32,1)
    :setInputLimit(31)
    :setInputType("password")

page102:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"confirmer mdp"/2), 10)
    :setText("confirmer mdp")
    :setSize(#"confirmer mdp",1)

local confirmMdp = page102:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 11)
    :setSize(32,1)
    :setInputLimit(31)
    :setInputType("password")

page102:addButton()
    :setPosition(1 + (x/2) - math.floor(#"envoyer"/2), 13)
    :setText("envoyer")
    :setSize(#"envoyer",1)
    :onClick(function()
        if page102alert then
            page102alert:remove()
        end
        if config.terminalPassword == oldMdp:getValue() then
            if newMdp:getValue() == confirmMdp:getValue() then
                config.terminalPassword = newMdp:getValue()
                configfile = fs.open("/config/terminal.lua", "w")
                configfile.write("config = " .. textutils.serialize(config))
                configfile.close()
                page102alert = page102:addLabel()
                    :setPosition(1 + (x/2) - math.floor(#"Mot de passe changé"/2), 15)
                    :setText("Mot de passe changé")
            else
                page102alert = page102:addLabel()
                    :setPosition(1 + (x/2) - math.floor(#"Les mots de passe ne correspondent pas"/2), 15)
                    :setText("Les mots de passe ne correspondent pas")
            end
        else
            page102alert = page102:addLabel()
                :setPosition(1 + (x/2) - math.floor(#"Mauvais mot de passe"/2), 15)
                :setText("Mauvais mot de passe")
        end
        page102aletTempo = 5
    end)

local timeLabel = page102:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page102TimeThread = page102:addThread()
page102TimeThread:start(function()
    page102aletTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page102aletTempo > 0 then
            page102aletTempo = page102aletTempo - 1
            if page102aletTempo == 0 then
                page102alert:remove()
            end
        end
    end
end)