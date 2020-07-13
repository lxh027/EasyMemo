import QtQuick 2.12
import QtQuick.Window 2.12

Window {
    id: window
    visible: true
    minimumHeight: 900
    maximumHeight: 900
    maximumWidth: 1440
    minimumWidth: 1440
    width: 1440
    height: 900
    title: qsTr("EasyMemo")

    Rectangle {
        id: header
        x: 0
        y: 0
        width: 1440
        height: 85
        color: "#333333"
        CustomBorder {
            commonBorder: false
            bBorderwidth: 3
            borderColor: "#666666"
        }

        Text {
            id: icon
            x: 74
            y: 24
            color: "#ff6600"
            text: qsTr("EasyMemo")
            font.bold: true
            font.family: "Bauhaus 93"
            verticalAlignment: Text.AlignVCenter
            horizontalAlignment: Text.AlignHCenter
            font.pixelSize: 30
        }

        Text {
            id: note_button
            x: 286
            y: 26
            color: "#ffffff"
            text: qsTr("笔记")
            font.family: "黑体"
            verticalAlignment: Text.AlignVCenter
            horizontalAlignment: Text.AlignHCenter
            font.pixelSize: 30
        }

        Text {
            id: search_button
            x: 386
            y: 26
            color: "#ffffff"
            text: qsTr("搜索")
            verticalAlignment: Text.AlignVCenter
            font.family: "黑体"
            horizontalAlignment: Text.AlignHCenter
            font.pixelSize: 30
        }
    }

    Rectangle {
        id: add_note
        x: 0
        y: 88
        width: 283
        height: 75
        color: "#333333"
        CustomBorder {
            commonBorder: false
            bBorderwidth: 3
            rBorderwidth: 3
            borderColor: "#666666"
        }

        Text {
            id: element
            x: 82
            y: 25
            color: "#ffffff"
            text: qsTr("添加笔记")
            font.family: "黑体"
            font.pixelSize: 30
        }
    }

    Rectangle {
        id: navigater
        x: 0
        y: 167
        width: 283
        height: 733
        color: "#333333"
        CustomBorder {
            commonBorder: false
            rBorderwidth: 3
            borderColor: "#666666"
        }

        ListView {
            id: listView
            x: 18
            y: 15
            width: 242
            height: 620
            model: ListModel {
                ListElement {
                    name: "笔记1"
                    nameColor: "white"
                    colorCode: "white"
                }
            }
            delegate: Item {
                x: 5
                width: 80
                height: 40
                Row {
                    id: row1
                    Rectangle {
                        width: 40
                        height: 40
                        color: colorCode
                    }

                    Text {
                        text: name
                        font.bold: true
                        color: nameColor
                        anchors.verticalCenter: parent.verticalCenter
                    }
                    spacing: 10
                }
            }
        }
    }

    Rectangle {
        id: footer
        x: 286
        y: 870
        width: 1154
        height: 30
        color: "#333333"
    }

    Rectangle {
        id: editor
        x: 286
        y: 88
        height: 782
        width: 577
        color: "#cccccc"

        Flickable {
            id: editorFlickableId
            x: 24
            y: 20
            width: textEdit.width
            contentHeight: textEdit.implicitHeight
            height: 736
            boundsMovement: Flickable.FollowBoundsBehavior
            boundsBehavior: Flickable.DragOverBounds
            visible: true
            clip: true
            anchors.centerIn: parent
            TextEdit {
                id: textEdit
                width: 520
                text: qsTr("")
                layer.wrapMode: ShaderEffectSource.Repeat
                layer.smooth: true
                verticalAlignment: Text.AlignTop
                focus: true
                renderType: Text.QtRendering
                font.family: "Monaco"
                selectByMouse: true
                enabled: true
                cursorVisible: true
                textFormat: Text.PlainText
                wrapMode: Text.WordWrap
                font.pixelSize: 17
                Keys.enabled: true
                onTextChanged: {
                    textView.text = textEdit.text
                    editorFlickableId.setCursor()
                }
                onCursorRectangleChanged: editorFlickableId.ensureVisible(cursorRectangle)
            }

            function setCursor() {
                var pos = textEdit.text.length;
                while (pos) {
                    textView.cursorPosition = pos;
                    if (textView.cursorPosition != 0) break;
                    pos--;
                }
            }

            function ensureVisible(r) {
                if (contentX >= r.x)
                    contentX = r.x
                else if (contentX + width <= r.x + r.width)
                    contentX = r.x + r.width - width
                if (contentY >= r.y)
                    contentY = r.y
                else if (contentY + height <= r.y + r.height)
                    contentY = r.y + r.height - height
            }
        }
    }


    Rectangle {
        id: viewer
        x: 863
        y: 88
        height: 782
        width: 577
        color: "#ffffff"
        Flickable {
            id: viewerFlickableId
            x: 24
            y: 20
            width: textView.width
            contentHeight: textView.implicitHeight
            height: 736
            clip: true
            anchors.centerIn: parent
            TextEdit {
                id: textView
                width: 520
                text: qsTr("")
                readOnly: false
                cursorVisible: true
                wrapMode: Text.WordWrap
                enabled: true
                textFormat: Text.RichText
                font.pixelSize: 17
                onCursorRectangleChanged: viewerFlickableId.ensureVisible(cursorRectangle)
            }
            function ensureVisible(r) {
                if (contentX >= r.x)
                    contentX = r.x
                else if (contentX + width <= r.x + r.width)
                    contentX = r.x + r.width - width
                if (contentY >= r.y)
                    contentY = r.y
                else if (contentY + height <= r.y + r.height)
                    contentY = r.y + r.height - height
            }
        }
    }

}

/*##^##
Designer {
    D{i:10;anchors_y:84}D{i:9;anchors_y:84}D{i:20;anchors_height:736;anchors_width:526;anchors_x:24;anchors_y:20}
}
##^##*/

