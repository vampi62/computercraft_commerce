page = 0

function routeur()
    entitie = {}
    button_list = {}
    nav()
    loadpage()
end
function nav()
    createobject(xmin,ymin,xmax,ymax,variable_print,back_color,text_color,action,para_action)
    createobject(1,1,10,1,"accueil",colors.gray,colors.white,"page","0")
    createobject(1,2,10,2,"generateur",colors.gray,colors.white,"page","10")
    createobject(1,3,10,3,"stockage",colors.gray,colors.white,"page","20")
    createobject(1,4,10,4,"prod",colors.gray,colors.white,"page","30")
    createobject(1,5,10,5,"ae",colors.gray,colors.white,"page","40")
    createobject(1,6,10,6,"securite",colors.gray,colors.white,"page","50")
    createobject(1,7,10,7,"autre",colors.gray,colors.white,"page","60")
    createobject(1,17,10,17,"login",colors.gray,colors.white,"page","1000")

end
function loadpage()
    if page == 1000 then

    end
    if page == 10 then
        createobject(1,1,10,1,"accueil",colors.gray,colors.white,"","")
    end
    createobject(xmin,ymin,xmax,ymax,variable_print,back_color,text_color,action,para_action)
    createobject(1,1,10,1,"accueil",colors.gray,colors.white,"page","0")
    createobject(1,2,10,2,"generateur",colors.gray,colors.white,"page","10")
    createobject(1,3,10,3,"stockage",colors.gray,colors.white,"page","20")
    createobject(1,4,10,4,"prod",colors.gray,colors.white,"page","30")
    createobject(1,5,10,5,"ae",colors.gray,colors.white,"page","40")
    createobject(1,6,10,6,"securite",colors.gray,colors.white,"page","50")
    createobject(1,7,10,7,"autre",colors.gray,colors.white,"page","60")
    createobject(1,8,10,8,"login",colors.gray,colors.white,"page","1000")

end
function active_button(name,para)
    if name == "page" then
        page = para
    end
    if name == "redstone" then
        reacteur.setInjectionRate(injectmod)
        reacteur.isIgnited()
		lazerE = lazer.getEnergy()
		inject = reacteur.getInjectionRate()
		fusion_prod = reacteur.getProducing()
		t4 = reacteur.getPlasmaHeat()
		t3 = reacteur.getCaseHeat()
        ineva[a] = evaporation[a].getInput()
        outeva[a] = evaporation[a].getOutput()
        tempeva[a] = evaporation[a].getTemperature() + 26.85
        level = reactor[reacactif].getControlRodLevel(0)
        reactor[reacactif].setAllControlRodLevels(level)
        if reactor[1].isActivelyCooled() == true then
            for a = 1, #reactor do
                fuelpur[a] = reactor[a].getFuelAmount()
                used[a] = reactor[a].getWasteAmount()
                full[a] =  reactor[a].getFuelAmountMax()
                temp1[a] = reactor[a].getFuelTemperature()
                levelrod[a] = reactor[a].getControlRodLevel(0)
                reaactif[a] = reactor[a].getActive()
                vapeur[reacactif] = reactor[reacactif].getHotFluidProducedLastTick()
                energy[reacpassif] = reactor[reacpassif].getEnergyProducedLastTick()
                fuelconso[reacactif] = reactor[reacactif].getFuelConsumedLastTick()
                fuelconso[reacpassif] = reactor[reacpassif].getFuelConsumedLastTick()
            end
        reactor[reacactif].setActive(true)
        turbine[turbine_zone1].setActive(false)
        turbine[a].setFluidFlowRateMax(1500)
        turbine[a].setInductorEngaged(true)
    end
end

function createobject(xmin,ymin,xmax,ymax,variable_print,back_color,text_color,action,para_action)
    entitie[#entitie+1].x = xmin
    entitie[#entitie+1].y = ymin
    entitie[#entitie+1].coclorback = back_color
    entitie[#entitie+1].coclortext = text_color
    entitie[#entitie+1].text = variable_print
    if action ~= "" then
        button_list[#button_list+1].xmin = xmin
        button_list[#button_list+1].ymin = ymin
        button_list[#button_list+1].xmax = xmax
        button_list[#button_list+1].ymax = ymax
        button_list[#button_list+1].name = action
        button_list[#button_list+1].para = para_action
    end
end

function print_term()
    while true do
        routeur()
        term.clear()
        for j=1, #entitie do
            term.setCursorPos(entitie[j].x,entitie[j].y)
            term.setBackgroundColor(entitie[j].coclorback)
            term.setTextColor(entitie[j].coclortext)
            term.write(entitie[j].text)
        end
    end
end
function touch()
    while true do
        local event, button, x, y = os.pullEvent("mouse_click")
        for j = 1, #button_list do
            if x >= button_list[j].xmin and x <= button_list[j].xmax then 
                if y >= button_list[j].ymin and y <= button_list[j].ymax then
                    active_button(button_list[j].name,button_list[j].para)
                end
            end
        end
    end
end



colors.white
colors.orange
colors.magenta
colors.lightBlue
colors.yellow
colors.lime
colors.pink
colors.gray
colors.lightGray
colors.cyan
colors.purple
colors.blue
colors.brown
colors.green
colors.red
colors.black