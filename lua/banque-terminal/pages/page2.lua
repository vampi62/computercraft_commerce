page2 = basalt.createFrame()
x, y = term.getSize()

page2:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"inscription"/2), 2)
    :setText("inscription")
    :setSize(#"inscription",1)

page2:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Pseudo"/2), 4)
    :setText("Pseudo")
    :setSize(#"Pseudo",1)

local pseudo = page2:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 5)
    :setSize(32,1)
    :setInputLimit(31)

page2:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Mot de passe"/2), 7)
    :setText("Mot de passe")
    :setSize(#"Mot de passe",1)

local mdp = page2:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 8)
    :setSize(32,1)
    :setInputLimit(31)
    :setInputType("password")

page2:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Confirmer mot de passe"/2), 10)
    :setText("Confirmer mot de passe")
    :setSize(#"Confirmer mot de passe",1)

local mdp2 = page2:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 11)
    :setSize(32,1)
    :setInputLimit(31)
    :setInputType("password")

page2:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Email"/2), 13)
    :setText("Email")
    :setSize(#"Email",1)

local email = page2:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 14)
    :setSize(32,1)
    :setInputLimit(31)

page2:addButton()
    :setPosition(1 + (x/2) - math.floor(#"inscription"/2), 16)
    :setText("inscription")
    :setSize(#"inscription",1)
    :onClick(function()
        if mdp:getValue() == mdp2:getValue() then
            local _inscription = api.inscriptionUser(pseudo:getValue(), mdp:getValue(), email:getValue())
            if _inscription[1] then
                basalt.setVariable("pseudo", pseudo:getValue())
                basalt.setVariable("mdp", mdp:getValue())
                pseudo:setValue("")
                mdp:setValue("")
                mdp2:setValue("")
                email:setValue("")
                page20:show()
            else
                if page2alert then
                    page2alert:remove()
                end
                page2alert = page2:addLabel()
                    :setPosition(1 + (x/2) - math.floor(#_inscription[2]/2), 18)
                    :setText(_inscription[2])
                    :setSize(#_inscription[2],1)
                    :setBackground(colors.black)
                    :setForeground(colors.red)
                page2alertTempo = 5
            end
        else
            if page2alert then
                page2alert:remove()
            end
            page2alert = page2:addLabel()
                :setPosition(1 + (x/2) - math.floor(#"Les mots de passe ne correspondent pas"/2), 18)
                :setText("Les mots de passe ne correspondent pas")
                :setSize(#"Les mots de passe ne correspondent pas",1)
            page2alertTempo = 5
        end
    end)


page2:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        pseudo:setValue("")
        mdp:setValue("")
        mdp2:setValue("")
        email:setValue("")
        page0:show()
    end)

local timeLabel = page2:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page2TimeThread = page2:addThread()
page2TimeThread:start(function()
    page2alertTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page2alertTempo > 0 then
            page2alertTempo = page2alertTempo - 1
            if page2alertTempo == 0 then
                page2alert:remove()
            end
        end
    end
end)