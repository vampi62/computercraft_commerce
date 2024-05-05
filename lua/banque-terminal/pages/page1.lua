page1 = basalt.createFrame()
x, y = term.getSize()

page1:addButton()
    :setPosition(1, 19)
    :setText("retour")
    :setSize(8,1)
    :onClick(function()
        page0:show()
    end)

page1:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"connexion"/2), 2)
    :setText("connexion")
    :setSize(#"connexion",1)

page1:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Pseudo"/2), 4)
    :setText("Pseudo")
    :setSize(#"Pseudo",1)

local pseudo = page1:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 5)
    :setSize(32,1)
    :setInputLimit(31)

page1:addLabel()
    :setPosition(1 + (x/2) - math.floor(#"Mot de passe"/2), 7)
    :setText("Mot de passe")
    :setSize(#"Mot de passe",1)

local mdp = page1:addInput()
    :setPosition(1 + (x/2) - math.floor(32/2), 8)
    :setSize(32,1)
    :setInputLimit(31)
    :setInputType("password")

page1:addButton()
    :setPosition(1 + (x/2) - math.floor(#"connexion"/2), 10)
    :setText("connexion")
    :setSize(#"connexion",1)
    :onClick(function()
        if api.connexionUser(pseudo:getValue(), mdp:getValue()) then
            page10:show()
        else
            if page1alert then
                page1alert:remove()
            end
            page1alert = page1:addLabel()
                :setPosition(1 + (x/2) - math.floor(#"Mauvais pseudo ou mot de passe"/2), 12)
                :setText("Mauvais pseudo ou mot de passe")
                :setSize(#"Mauvais pseudo ou mot de passe",1)
            page1aletTempo = 5
        end
    end)

page1:addButton()
    :setPosition(1 + (x/2) - math.floor(#"mot de passe oublié ?"/2), 12)
    :setText("mot de passe oublié ?")
    :setSize(#"mot de passe oublié ?",1)
    :onClick(function()
        page3:show()
    end)


local timeLabel = page1:addLabel()
    :setPosition(51 - #os.date("%d/%m/%Y %H:%M"), 19)
    :setText(os.date("%d/%m/%Y %H:%M"))
    :setSize(#os.date("%d/%m/%Y %H:%M"),1)

page1TimeThread = page1:addThread()
page1TimeThread:start(function()
    page1aletTempo = 0
    while true do
        timeLabel:setText(os.date("%d/%m/%Y %H:%M"))
        sleep(1)
        if page1aletTempo > 0 then
            page1aletTempo = page1aletTempo - 1
            if page1aletTempo == 0 then
                page1alert:remove()
            end
        end
    end
end)