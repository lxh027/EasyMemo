#include "MainWindow.h"

MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent)
{
    initUI();
}

void MainWindow::initUI()
{
    if (this->objectName().isEmpty())
        this->setObjectName(QString::fromUtf8("MainWindowClass"));
    this->setFixedSize(1440, 900);
    centralWidget = new QWidget(this);
    centralWidget->setObjectName(QString::fromUtf8("centralWidget"));
    gridLayoutWidget = new QWidget(centralWidget);
    gridLayoutWidget->setObjectName(QString::fromUtf8("gridLayoutWidget"));
    gridLayoutWidget->setGeometry(QRect(0, 0, 1440, 900));
    gridLayout = new QGridLayout(gridLayoutWidget);
    gridLayout->setSpacing(6);
    gridLayout->setContentsMargins(11, 11, 11, 11);
    gridLayout->setObjectName(QString::fromUtf8("gridLayout"));
    gridLayout->setContentsMargins(0, 0, 0, 0);
    horizontalLayout_4 = new QHBoxLayout();
    horizontalLayout_4->setSpacing(6);
    horizontalLayout_4->setObjectName(QString::fromUtf8("horizontalLayout_4"));
    horizontalSpacer_2 = new QSpacerItem(40, 20, QSizePolicy::Expanding, QSizePolicy::Minimum);

    horizontalLayout_4->addItem(horizontalSpacer_2);

    readonly = new QRadioButton(gridLayoutWidget);
    readonly->setObjectName(QString::fromUtf8("readonly"));

    horizontalLayout_4->addWidget(readonly);


    gridLayout->addLayout(horizontalLayout_4, 1, 0, 1, 1);

    verticalLayout_2 = new QVBoxLayout();
    verticalLayout_2->setSpacing(6);
    verticalLayout_2->setObjectName(QString::fromUtf8("verticalLayout_2"));
    horizontalLayout = new QHBoxLayout();
    horizontalLayout->setSpacing(6);
    horizontalLayout->setObjectName(QString::fromUtf8("horizontalLayout"));
    icon = new QLabel(gridLayoutWidget);
    icon->setObjectName(QString::fromUtf8("icon"));

    horizontalLayout->addWidget(icon);

    pushButton = new QPushButton(gridLayoutWidget);
    pushButton->setObjectName(QString::fromUtf8("pushButton"));

    horizontalLayout->addWidget(pushButton);

    noteButton = new QPushButton(gridLayoutWidget);
    noteButton->setObjectName(QString::fromUtf8("noteButton"));

    horizontalLayout->addWidget(noteButton);

    horizontalSpacer = new QSpacerItem(500, 20, QSizePolicy::Fixed, QSizePolicy::Minimum);

    horizontalLayout->addItem(horizontalSpacer);


    verticalLayout_2->addLayout(horizontalLayout);

    verticalSpacer = new QSpacerItem(20, 3, QSizePolicy::Minimum, QSizePolicy::Fixed);

    verticalLayout_2->addItem(verticalSpacer);

    horizontalLayout_2 = new QHBoxLayout();
    horizontalLayout_2->setSpacing(6);
    horizontalLayout_2->setObjectName(QString::fromUtf8("horizontalLayout_2"));
    verticalLayout = new QVBoxLayout();
    verticalLayout->setSpacing(6);
    verticalLayout->setObjectName(QString::fromUtf8("verticalLayout"));
    addNote = new QPushButton(gridLayoutWidget);
    addNote->setObjectName(QString::fromUtf8("addNote"));

    verticalLayout->addWidget(addNote);

    divider = new QFrame(gridLayoutWidget);
    divider->setObjectName(QString::fromUtf8("divider"));
    divider->setFrameShape(QFrame::HLine);
    divider->setFrameShadow(QFrame::Sunken);

    verticalLayout->addWidget(divider);

    noteList = new QTreeView(gridLayoutWidget);
    noteList->setObjectName(QString::fromUtf8("noteList"));

    verticalLayout->addWidget(noteList);


    horizontalLayout_2->addLayout(verticalLayout);

    editSpace = new QPlainTextEdit(gridLayoutWidget);
    editSpace->setObjectName(QString::fromUtf8("editSpace"));

    horizontalLayout_2->addWidget(editSpace);

    textEdit = new QTextEdit(gridLayoutWidget);
    textEdit->setObjectName(QString::fromUtf8("textEdit"));

    horizontalLayout_2->addWidget(textEdit);


    verticalLayout_2->addLayout(horizontalLayout_2);


    gridLayout->addLayout(verticalLayout_2, 0, 0, 1, 1);

    this->setCentralWidget(centralWidget);

    retranslateUi();

    QMetaObject::connectSlotsByName(this);
}

void MainWindow::retranslateUi()
{
    this->setWindowTitle(QApplication::translate("MainWindowClass", "MainWindow", nullptr));
    readonly->setText(QApplication::translate("MainWindowClass", "\345\217\252\350\257\273\346\250\241\345\274\217", nullptr));
    icon->setText(QApplication::translate("MainWindowClass", "EasyMemo", nullptr));
    pushButton->setText(QApplication::translate("MainWindowClass", "\346\220\234\347\264\242", nullptr));
    noteButton->setText(QApplication::translate("MainWindowClass", "\347\254\224\350\256\260", nullptr));
    addNote->setText(QApplication::translate("MainWindowClass", "\346\267\273\345\212\240\347\254\224\350\256\260", nullptr));
}