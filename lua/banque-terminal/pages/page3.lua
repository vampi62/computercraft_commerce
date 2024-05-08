page3 = basalt.createFrame()
x, y = term.getSize()

page3:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"mot de passe oublié"/2), 2)
    :setText("mot de passe oublié")
    :setSize(#"mot de passe oublié",1)

page3:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Pseudo"/2), 4)
    :setText("Pseudo")
    :setSize(#"Pseudo",1)

local pseudo = page3:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 5)
    :setSize(32,1)
    :setInputLimit(31)

page3:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Email"/2), 7)
    :setText("Email")
    :setSize(#"Email",1)

local email = page3:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 8)
    :setSize(32,1)
    :setInputLimit(31)

page3:addButton()
    :setPosition(1 + (x/2) - math.floor(#"envoyer"/2), 10)
    :setText("envoyer")
    :setSize(#"envoyer",1)
    :onClick(function()
        local _mdpoublie = api.mdpOublie(pseudo:getValue(), email:getValue())
        if _mdpoublie[1] then
            basalt.setVariable("pseudo", pseudo:getValue())
            basalt.setVariable("email", email:getValue())
            page4:show()
        else
            if page3alert then
                page3alert:remove()
            end
            page3alert = page3:addLabel()
                :setPosition(1 + (x/2) - math.floor(#_mdpoublie[2]/2), 16)
                :setText(_mdpoublie[2])
                :setSize(#_mdpoublie[2],1)
                :setBackground(colors.black)
                :setForeground(colors.red)
            page3alertTempo = 5
        end
    end)


page3:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        pseudo:setValue("")
        email:setValue("")
        page1:show()
    end)

local timeLabel = page3:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page3TimeThread = page3:addThread()
page3TimeThread:start(function()
    page3alertTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page3alertTempo > 0 then
            page3alertTempo = page3alertTempo - 1
            if page3alertTempo == 0 then
                page3alert:remove()
            end
        end
    end
end)