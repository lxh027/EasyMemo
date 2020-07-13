#pragma once

#include <QtWidgets/QMainWindow>
#include <QtCore/QVariant>
#include <QtWidgets/QApplication>
#include <QtWidgets/QFrame>
#include <QtWidgets/QGridLayout>
#include <QtWidgets/QHBoxLayout>
#include <QtWidgets/QHeaderView>
#include <QtWidgets/QLabel>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QPlainTextEdit>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QRadioButton>
#include <QtWidgets/QSpacerItem>
#include <QtWidgets/QTextEdit>
#include <QtWidgets/QTreeView>
#include <QtWidgets/QVBoxLayout>
#include <QtWidgets/QWidget>

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    MainWindow(QWidget *parent = Q_NULLPTR);
    ~MainWindow();
private:
    QWidget* centralWidget;
    QWidget* gridLayoutWidget;
    QGridLayout* gridLayout;
    QHBoxLayout* horizontalLayout_4;
    QSpacerItem* horizontalSpacer_2;
    QRadioButton* readonly;
    QVBoxLayout* verticalLayout_2;
    QHBoxLayout* horizontalLayout;
    QLabel* icon;
    QPushButton* pushButton;
    QPushButton* noteButton;
    QSpacerItem* horizontalSpacer;
    QSpacerItem* verticalSpacer;
    QHBoxLayout* horizontalLayout_2;
    QVBoxLayout* verticalLayout;
    QPushButton* addNote;
    QFrame* divider;
    QTreeView* noteList;
    QPlainTextEdit* editSpace;
    QTextEdit* textEdit;
   
    void initUI();
    void retranslateUi();
    void readQss();
};
