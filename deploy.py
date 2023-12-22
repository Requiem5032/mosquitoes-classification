from tensorflow.keras.saving import load_model
from tkinter import *
from tkinter import filedialog as fd
from PIL import Image, ImageTk
import numpy as np
import tensorflow as tf
import cv2
import os
os.environ['CUDA_VISIBLE_DEVICES'] = '-1'

IMG_DIM = 224
IMG_SIZE = (IMG_DIM, IMG_DIM)
IMG_SHAPE = IMG_SIZE + (3,)

class_names = ['Aedes Aegypti', 'Culex Quinquefasciatus']
model = load_model('models/deploy_model.keras')

root = Tk()
root.title('Deploy')


def open():
    root.filename = fd.askopenfilename(
        title='Open a file',
        filetypes=(
            ('jpg', '*.jpg'),
            ('jpeg', '*.jpeg'),
            ('png', '*.png'),
            ('all', '*.*'),
        )
    )

    img_array = cv2.imread(root.filename)
    img_array = cv2.cvtColor(img_array, cv2.COLOR_BGR2RGB)
    img_array = cv2.resize(img_array, IMG_SIZE, interpolation=cv2.INTER_LINEAR)

    x = np.expand_dims(img_array / 255, 0)

    yhat = model.predict(x)
    yhat = tf.nn.softmax(yhat[0])
    yhat = np.array(yhat)

    pred = class_names[np.argmax(yhat)]

    img = ImageTk.PhotoImage(image=Image.fromarray(img_array))
    Label(root, text=pred).pack()
    img_panel = Label(root, image=img).pack()
    img_panel.photo=img


open_button = Button(root, text='Select an image', command=open).pack()

root.mainloop()
