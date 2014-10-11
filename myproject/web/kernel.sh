#! /bin/bash

echo $2 > file_input
echo $3 > file_output

if [[ $4 = "c" ]];then
    echo $1 > main.c
    compile=`./filtr_c.sh $1`
    if [[ $compile = "ok" ]];then
        res=`./compile_c.sh main.c file_input`
        if [[ $res = "" ]]; then
            echo "erreur de compilation !"
        else
            echo $res > file
            cmp -s file file_output
            if [ $? -eq 0 ] ; then
                echo "Bravo!"
            else
                echo "Wrong Answer"
            fi
        fi
    else
        echo "votre code peuve  de sécurité !"
    fi
elif [[ $4 = "cpp" ]]; then
    echo $1 > main.cpp
    compile=`./filtr_cpp.sh $1`
    if [[ $compile = "ok" ]]; then
        res=`./compile_cpp.sh main.cpp file_input`
        if [[ $res = "" ]]; then
        echo "erreur de compilation !"
        else
        echo $res > file
        cmp -s file file_output
            if [ $? -eq 0 ] ; then
            echo "Bravo!"
            else
            echo "Wrong Answer"
            fi
        fi
    else
        echo "votre code peuve  de sécurité !"
    fi

elif [[ $4 = "java" ]]; then
    echo $1 > main_java.java
    compile=`./filtr_java.sh $1`
    if [[ $compile = "ok" ]]; then
        res=`./compile_java.sh main_java.java file_input`
        if [[ $res = "erreur de compilation" ]]; then
            echo "$res"
        else
            echo $res > file
            cmp -s file file_output
            if [ $? -eq 0 ] ; then
                echo "Bravo!"
            else
                echo "Wrong Answer"
            fi
        fi
    else
        echo "votre code peuve  de sécurité !"
    fi
elif [[ $4 = "python" ]]; then
    echo $1 > main.py
    compile=`./filtr_py.sh $1`
    if [[ $compile = "ok" ]]; then
        res=`./compile_py.sh main.py file_input`
        if [[ $res = "" ]]; then
            echo "erreur de compilation !"
        else
            echo $res > file
            cmp -s file file_output
            if [ $? -eq 0 ] ; then
                echo "Bravo!"
            else
                echo "Wrong Answer"
            fi
        fi
    else
        echo "votre code peuve  de sécurité !"
    fi
elif [[ $4 = "shell" ]]; then
    echo $1 > main.sh
    compile=`./filtr_sh.sh $1`
    if [[ $compile = "ok" ]]; then
        res=`./compile_sh.sh main.sh file_input`
        if [[ $res = "" ]]; then
            echo "erreur de compilation !"
        else
            echo $res > file
            cmp -s file file_output
            if [ $? -eq 0 ] ; then
                echo "Bravo!"
            else
                echo "Wrong Answer"
            fi
        fi
    else
        echo "votre code peuve  de sécurité !"
    fi
fi
