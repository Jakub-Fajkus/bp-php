<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class AntLinearModelXml
 * @package Simulator\Model
 */
class AntLinearModelXml implements ModelXmlInterface
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
        <!--<material name="spiral_mat"  texture="spiral" texrepeat="1 1"/>-->
    </asset>
    <visual>
        <global offwidth="1920" offheight="1080"/>
        <map stiffness="10" stiffnessrot="20"/>
    </visual>


    <worldbody>
        <camera name='targeting' pos='1 1 2' mode='targetbodycom' target='body_0'/>

        <geom name="floor" material="checker_mat" pos="30 50 -20" size="420 420 .125" rgba="1 1 1 1" type="plane"
              condim="6" friction="5 0.5 0.1"/>

        <site name="reference_0" pos="130 0 -15" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_1" pos="180 0 -15" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_2" pos="230 0 -15" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_3" pos="280 0 -15" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_4" pos="330 0 -15" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_5" pos="380 0 -15" size="5 5 5" type="sphere" rgba="255 255 0 1"/>
        <site name="reference_6" pos="430 0 -15" size="5 5 5" type="sphere" rgba="255 255 0 1"/>


        <body name="body_0">
            <freejoint/>
            <site name="head" size="2 2 2" rgba="1 0 0 0.5" pos="80 0 0"/>
            <geom name="geom_0" type="sphere" pos="0.00 0.00 0.20" size="0.3"/>
            <body name="body_1">
                <!--1st arms-->
                <geom name="geom_1" type="capsule" fromto="0.00 0.00 0.00 0.00 10.0 10.0" size="01.00000"/>
                <geom name="geom_2" type="capsule" fromto="0.00 0.00 0.00 0.00 -10.0 10.0" size="01.00000"/>
                <!--spine-->
                <geom name="geom_3" type="capsule" fromto="0.00 0.00 0.00 80.0 0.00 0.00" size="01.00000"/>
                <!--contact point which is used to create heading vector-->
                <geom name="contact_1" type="sphere" pos="0.00 0.00 0.00" size="0.01" rgba="1 0 1 0.5" density="1"/>

                <!--2nd arms-->
                <geom name="geom_4" type="capsule" fromto="40.0 0.00 0.00 40.0 10.0 10.0" size="01.00000"/>
                <geom name="geom_5" type="capsule" fromto="40.0 0.00 0.00 40.0 -10.0 10.0" size="01.00000"/>

                <!--3rd arms-->
                <geom name="geom_18" type="capsule" fromto="80.0 0.00 0.00 80.0 10.0 10.0" size="01.00000"/>
                <geom name="geom_19" type="capsule" fromto="80.0 0.00 0.00 80.0 -10.0 10.0" size="01.00000"/>

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

                <!--third leg pair-->
                <!--upper leg-->
                <body name="body_10">
                    <joint type="hinge" pos="80 -10 10" axis="0 0 1" limited="true" range="-45 45" name="motor_8"/>
                    <geom name="geom_14" type="capsule" fromto="80 -10.0 10.0 80 -20.0 10.0" size="01.00000"/>
                    <!--lower leg-->
                    <body name="body_11">
                        <joint type="hinge" pos="80 -20 10" axis="1 0 0" limited="true" range="-20 45" name="motor_9"/>
                        <geom name="geom_15" type="capsule" fromto="80 -20.0 10.0 80 -30.0 -5.0" size="01.00000"/>
                    </body>
                </body>
                <!--upper leg-->
                <body name="body_12">
                    <joint type="hinge" pos="80 10 10" axis="0 0 1" limited="true" range="-45 45" name="motor_10"/>
                    <geom name="geom_16" type="capsule" fromto="80 10.0 10.0 80 20.0 10.0" size="01.00000"/>
                    <!--lower leg-->
                    <body name="body_13">
                        <joint type="hinge" pos="80 20 10" axis="1 0 0" limited="true" range="-20 45" name="motor_11"/>
                        <geom name="geom_17" type="capsule" fromto="80 20.0 10.0 80 30.0 -0.5" size="01.00000"/>
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
        <motor name="motor_8" joint="motor_8" gear="100000"/>
        <motor name="motor_9" joint="motor_9" gear="100000"/>
        <motor name="motor_10" joint="motor_10" gear="100000"/>
        <motor name="motor_11" joint="motor_11" gear="100000"/>
    </actuator>
</mujoco>
MODEL;

        return $model;
    }
}
