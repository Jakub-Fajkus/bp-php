<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class ThreeLegLinearModelXml
 * @package Simulator\Model
 */
class ThreeLegLinearModelXml implements ModelXmlInterface
{
    /**
     * Returns the model xml as a string
     *
     * @return string
     */
    public function getAsString(): string
    {
        $model = <<<MODEL
<mujoco>
    <option timestep="0.02" viscosity="0" density="0" gravity="0 0 -9.81" collision="dynamic"/>
    <compiler coordinate="global" angle="degree"/>
    <default>
        <geom rgba=".8 .6 .4 1"/>
        <joint limited="true"/>
    </default>
    <asset>
        <texture type="skybox" builtin="gradient" rgb1="1 1 1" rgb2=".6 .8 1" width="256" height="256"/>
        <texture type="2d" name="checkers" builtin="checker" width="256" height="256" rgb1="0 0 0" rgb2="1 1 1"/>
        <material name="checker_mat" texture="checkers" texrepeat="15 15"/>
    </asset>
    <visual>
        <global offwidth="1920" offheight="1080"/>
    </visual>
    
    <sensor>
        <jointpos name="sensor_jointpos_0" joint="motor_0"/>
        <jointpos name="sensor_jointpos_1" joint="motor_1"/>
        <jointpos name="sensor_jointpos_2" joint="motor_2"/>
    </sensor>
    
    <worldbody>
        <camera name='targeting' pos='1 1 2' mode='targetbodycom' target='body_0'/>

        <geom name="floor" material="checker_mat" pos="0 0 -20" size="420 420 .125" rgba="1 1 1 1" type="plane"
              condim="6" friction="5 0.5 0.1"/>

        <site name="reference_0" pos="50 0 -20" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_1" pos="100 0 -20" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_2" pos="150 0 -20" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_3" pos="200 0 -20" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_4" pos="250 0 -20" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_5" pos="300 0 -20" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_6" pos="350 0 -20" size="5 5 5" type="sphere" rgba="255 255 0 1"/>

        <body name="body_0">
            <freejoint/>
            <site name="head" size="1.5 1.5 1.5" rgba="1 0 0 0.5" pos="0.00 0.00 -10"/>
            <geom name="geom_0" type="sphere" pos="0.00 0.00 -10" size="0.8" rgba="1 0 1 0.5"/>
            <body name="body_1">
                <geom name="geom_1" type="capsule" fromto="0.00 0.00 -10.00 10.00 0.00 0.00" size="1.00"/>
                <geom name="contact_0" type="sphere" pos="10.00 0.00 0.00" size="2" rgba="1 0 1 0.5"/>

                <geom name="geom_2" type="capsule" fromto="0.00 0.00 -10.00 0.00 10 0.00"  size="1.00"/>
                <body name="body_4">
                    <joint type="hinge" pos="0.00 0.00 -10.00" axis="0 0 1" limited="true"  range="0 45" name="motor_back_leg"/>
                    <geom name="geom_3" type="capsule" fromto="0.00 0.00 -10.00 -5.00 0.00 0.00" size="1.00"/>
                    <body name="body_7">
                        <joint type="hinge" pos="-5.00 0.00 0.00" axis="0 1 0" limited="true" range="0 50" name="motor_0"/>
                        <geom name="contact_1" type="sphere" pos="-5.00 0.00 0.00" size="2" rgba="1 0 1 0.5"/>
                        <geom name="geom_4" type="capsule" fromto="-5.00 0.00 0.00 -10.00 0.00 -18" size="1.00"/>
                    </body>
                </body>
                <body name="body_2">
                    <joint type="hinge" pos="10.00 0.00 0.00" axis="0 1 0" limited="true" range="-50 0" name="motor_2"/>
                    <geom name="geom_5" type="capsule" fromto="10.00 0.00 0.00 10.00 0.00 -18" size="1.00"/>
                </body>
                <body name="body_3">
                    <joint type="hinge" pos="0.00 10.00 0.00" axis="1 0 0" limited="true" range="0 50" name="motor_1"/>
                    <geom name="contact_2" type="sphere" pos="0.00 10.00 0.00" size="2" rgba="1 0 1 0.5"/>
                    <geom name="geom_7" type="capsule" fromto="0.00 10.00 0.00 0.00 10.00 -18" size="1.00"/>
                </body>
            </body>
        </body>
    </worldbody>

    <actuator>
        <motor name="motor_0" joint="motor_0" gear="100000"/>
        <motor name="motor_1" joint="motor_1" gear="100000"/>
        <motor name="motor_2" joint="motor_2" gear="100000"/>
        <motor name="motor_back_leg" joint="motor_back_leg" gear="100000"/>
    </actuator>
</mujoco>
MODEL;

        return $model;
    }
}
