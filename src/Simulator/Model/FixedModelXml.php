<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class FixedModelXml
 * @package Simulator\Model
 */
class FixedModelXml implements ModelXmlInterface
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
        <global offwidth="800" offheight="800"/>
    </visual>
    <worldbody>
        <camera name='targeting' pos='1 1 2' mode='targetbodycom' target='body_0'/>

        <geom name="floor" material="checker_mat" pos="0 0 -10" size="420 420 .125" rgba="1 1 1 1" type="plane"
              condim="6" friction="5 0.5 0.1"/>

        <site name="reference_0" pos="100 0 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_1" pos="180 -20 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_2" pos="200 -100 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_3" pos="170 -200 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_4" pos="120 -240 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_5" pos="35 -265 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_6" pos="-50 -260 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_7" pos="-145 -225 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_8" pos="-240 -160 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_9" pos="-240 -160 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_10" pos="-290 -55 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_11" pos="-310 50 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_12" pos="-300 150 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_13" pos="-250 235 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_14" pos="-200 300 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_15" pos="-100 350 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_16" pos="0 375 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_17" pos="100 400 0" size="5 5 5" type="sphere" rgba="255 255 0 1"/>


        <body name="body_0">
            <freejoint/>
            <site name="head" size="2 2 2" rgba="1 0 0 0.5" pos="40 0 0"/>
            <geom name="geom_0" type="sphere" pos="0.00 0.00 0.20" size="0.3"/>
            <body name="body_1">
                <!--arms-->
                <geom name="geom_1" type="capsule" fromto="0.00 0.00 0.00 0.00 10.0 10.0" size="01.00000"/>
                <geom name="geom_2" type="capsule" fromto="0.00 0.00 0.00 0.00 -10.0 10.0" size="01.00000"/>
                <!--spine-->
                <geom name="geom_3" type="capsule" fromto="0.00 0.00 0.00 40.0 0.00 0.00" size="01.00000"/>
                <!--arms-->
                <geom name="geom_4" type="capsule" fromto="40.0 0.00 0.00 40.0 10.0 10.0" size="01.00000"/>
                <geom name="geom_5" type="capsule" fromto="40.0 0.00 0.00 40.0 -10.0 10.0" size="01.00000"/>

                <!--first leg pair-->
                <!--upper leg-->
                <body name="body_2">
                    <joint type="hinge" pos="0 -10 10" axis="0 0 1" limited="true" range="-45 45" name="motor_0"/>
                    <geom name="geom_6" type="capsule" fromto="0.00 -10.0 10.0 0.00 -20.0 10.0" size="01.00000"/>
                    <!--lower leg-->
                    <body name="body_3">
                        <joint type="hinge" pos="0 -20 10" axis="1 0 0" limited="true" range="-20 45" name="motor_1"/>
                        <geom name="geom_7" type="capsule" fromto="0.00 -20.0 10.0 0.00 -30.0 -5.0" size="01.00000"/>
                    </body>
                </body>
                <!--upper leg-->
                <body name="body_4">
                    <joint type="hinge" pos="0 10 10" axis="0 0 1" limited="true" range="-45 45" name="motor_2"/>
                    <geom name="geom_8" type="capsule" fromto="0.00 10.0 10.0 0.00 20.0 10.0" size="01.00000"/>
                    <!--lower leg-->
                    <body name="body_5">
                        <joint type="hinge" pos="0 20 10" axis="1 0 0" limited="true" range="-20 45" name="motor_3"/>
                        <geom name="geom_9" type="capsule" fromto="0.00 20.0 10.0 0.00 30.0 -5" size="01.00000"/>
                    </body>
                </body>

                <!--second leg pair-->
                <!--upper leg-->
                <body name="body_6">
                    <joint type="hinge" pos="40 -10 10" axis="0 0 1" limited="true" range="-45 45" name="motor_4"/>
                    <geom name="geom_10" type="capsule" fromto="40.0 -10.0 10.0 40.0 -20.0 10.0" size="01.00000"/>
                    <!--lower leg-->
                    <body name="body_7">
                        <joint type="hinge" pos="40 -20 10" axis="1 0 0" limited="true" range="-20 45" name="motor_5"/>
                        <geom name="geom_11" type="capsule" fromto="40.0 -20.0 10.0 40.0 -30.0 -5.0" size="01.00000"/>
                    </body>
                </body>
                <!--upper leg-->
                <body name="body_8">
                    <joint type="hinge" pos="40 10 10" axis="0 0 1" limited="true" range="-45 45" name="motor_6"/>
                    <geom name="geom_12" type="capsule" fromto="40.0 10.0 10.0 40.0 20.0 10.0" size="01.00000"/>
                    <!--lower leg-->
                    <body name="body_9">
                        <joint type="hinge" pos="40 20 10" axis="1 0 0" limited="true" range="-20 45" name="motor_7"/>
                        <geom name="geom_13" type="capsule" fromto="40.0 20.0 10.0 40.0 30.0 -0.5" size="01.00000"/>
                    </body>
                </body>
            </body>
        </body>
    </worldbody>

    <actuator>
        <motor name="motor_0" joint="motor_0" gear="100000"/>
        <motor name="motor_1" joint="motor_1" gear="100000"/>
        <motor name="motor_2" joint="motor_2" gear="100000"/>
        <motor name="motor_3" joint="motor_3" gear="100000"/>
        <motor name="motor_4" joint="motor_4" gear="100000"/>
        <motor name="motor_5" joint="motor_5" gear="100000"/>
        <motor name="motor_6" joint="motor_6" gear="100000"/>
        <motor name="motor_7" joint="motor_7" gear="100000"/>
    </actuator>
</mujoco>
MODEL;

        return $model;
    }
}
