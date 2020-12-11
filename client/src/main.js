const { app, BrowserWindow, ipcMain } = require('electron')
const cfg = require('../config/config')

let login_win = null
let register_win = null
let main_win = null
let edit_win = null

function createLoginWindow() {
    login_win = new BrowserWindow({
        width: 480,
        height: 360,
        webPreferences: {
            nodeIntegration: true
        },
        resizable: true,
        autoHideMenuBar: true
    })
    login_win.loadFile("./src/pages/login.html")
}

function createRegisterWindow() {
    register_win = new BrowserWindow({
        width: 480,
        height: 580,
        webPreferences: {
            nodeIntegration: true
        },
        resizable: false,
        autoHideMenuBar: true
    })
    register_win.loadFile("./src/pages/register.html")
}

function createMainWindow() {
    main_win = new BrowserWindow({
        width: 550,
        height: 800,
        webPreferences: {
            nodeIntegration: true
        },
        resizable: false,
        autoHideMenuBar: true
    })
    main_win.loadFile("./src/pages/index.html")
    main_win.on('closed', () => {
        if (edit_win != null && !edit_win.isDestroyed()) {
            edit_win.close()
        }
    })
}

function createEditWindow() {

    if (main_win != null && !main_win.isDestroyed()) {
        main_win.setPosition(main_win.getPosition()[0]-500, main_win.getPosition()[1])
        const main_pos = main_win.getPosition()
        const main_size = main_win.getSize()
        edit_win = new BrowserWindow({
            width: 1000,
            height: 800,
            x: main_pos[0]+main_size[0],
            y: main_pos[1],
            webPreferences: {
                nodeIntegration: true
            },
            resizable: false,
            autoHideMenuBar: true
        })
    } else {
        edit_win = new BrowserWindow({
            width: 1000,
            height: 800,
            webPreferences: {
                nodeIntegration: true
            },
            resizable: false,
            autoHideMenuBar: true
        })
    }
    edit_win.on('closed', () => {
        if (main_win != null && !main_win.isDestroyed())
            main_win.setPosition(main_win.getPosition()[0]+500, main_win.getPosition()[1])
    })
}

app.whenReady().then(createLoginWindow)

ipcMain.on('to_login', () => {
    createLoginWindow()
    register_win.close()
})

ipcMain.on('logout', () => {
    createLoginWindow()
    main_win.close()
})

ipcMain.on('to_register', () => {
    createRegisterWindow()
    login_win.close()
})

ipcMain.on('to_index', () => {
    createMainWindow()
    login_win.close()
})

ipcMain.on('to_edit', async (event, data) => {
    if (edit_win == null || edit_win.isDestroyed()) {
        createEditWindow()
        await edit_win.loadFile("./src/pages/edit.html")
        edit_win.webContents.send('memo', data)
    } else {
        edit_win.webContents.send('memo', data)
    }
})

ipcMain.on('guest', async () => {
    if (edit_win == null || edit_win.isDestroyed()) {
        createEditWindow()
        await edit_win.loadFile("./src/pages/edit.html")
        edit_win.webContents.send('guest', data)
    }
})

ipcMain.on('load_index', () => {
    main_win.webContents.send('load_index')
})

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit()
    }
})

app.on('activate', () => {
    if (BrowserWindow.getAllWindows().length === 0) {
        createLoginWindow()
    }
})