import matplotlib.pyplot as plt


def draw_confusion_matrix(cm, labels):
    class_num = len(labels)
    tick_marks = range(class_num)
    thresh = (cm.max()-cm.min()) / 2

    fig, ax = plt.subplots()
    im = ax.matshow(cm, cmap=plt.cm.gray_r)
    fig.colorbar(im)

    for i in range(class_num):
        for j in range(class_num):
            fg = None
            if cm[i, j] < thresh:
                fg = 'black'
            else:
                fg = 'white'
            ax.text(x=j,
                    y=i,
                    s=cm[i, j],
                    ha='center',
                    va='center',
                    ma='center',
                    color=fg,
                    size='x-large',
                    )

    ax.set_xticks(tick_marks)
    ax.set_yticks(tick_marks)

    plt.setp(ax.set_xticklabels(labels),
             ha='center',
             va='bottom',
             ma='center',
             rotation='horizontal',
             rotation_mode='default',
             )
    plt.setp(ax.set_yticklabels(labels),
             ha='right',
             va='center',
             ma='center',
             rotation='horizontal',
             rotation_mode='default',
             )